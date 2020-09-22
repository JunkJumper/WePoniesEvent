#@author Yashn37
# -*- coding: utf-8 -*-
# Parse quotes from transcripts, save them in "quotes_base_{0}_{1}.txt".format(MINIMUM, MAXIMUM). Transcripts url are expected to be listed in "list_of_transcripts.txt"

import requests
import sys
from html.parser import HTMLParser
import re

# select quotes with minimum and maximum length
# MINIMUM to be an interesting enough quote
# MAXIMUM because of tweets' limit length
MINIMUM = 2
MAXIMUM = 999

class QuoteParser(HTMLParser):
	quotes = [] # list of (character_name, quote) from an episode - this is the variable to fill after parsing a transcript
	is_name = False # indicates if the next data to read is a character_name (True) or a quote (False)
	is_music = True # indicates if the character is talking (e.g. 'Fluttershy') or singing (e.g. '[Fluttershy]')
	current_name = "" # name of the character talking/singing
	current_sentence = "" # his/her quote

	def handle_starttag(self, tag, attrs):
		if tag == "dd": self.current_sentence = "" # new line in transcript
		if tag == "b": self.is_name = True # the next data to read is a name (bold in transcripts)

	def handle_endtag(self, tag):
		# line ended: current quote filtering and processing
		if tag == "dd":
			if self.current_sentence.startswith(": "): self.current_sentence = self.current_sentence[2:] # quotes almost always starts with ': ' in transcripts - remove it
			self.current_sentence = self.current_sentence.replace("\n", "") # remove any potential '\n'
			self.current_sentence = re.sub(r'\[.+?\]', '', self.current_sentence) # remove elements like '[coughs]' or '[laughing]'
			self.current_sentence = re.sub(r'\(.+?\)', '', self.current_sentence) # remove elements like '(chorus)'
			if len(self.current_sentence) == 0 or self.current_sentence[-1] == "—": return # after filtering, quote is either empty or not complete (e.g. was just '[laughing]'), skip it
			
			if self.current_sentence[0] == '"' and  self.current_sentence[-1] == '"': self.current_sentence = self.current_sentence[1:-1] # remove eventuals '"' around the not empty quote
			
			# testing quote size (has to be between MINIMUM and MAXIMUM
			if len(self.current_sentence) < MINIMUM or len(self.current_sentence) + len(self.current_name) > MAXIMUM: return
			
			# quote meets all requirement and has been processed, add it to the quotes list
			self.quotes.append((self.current_name, self.current_sentence.strip()))
		
		# we just read the name of the character talking
		if tag == "b": self.is_name = False
		

	def handle_data(self, data):
		# data concerns the name of the character
		if self.is_name == True:
			# character name in '[]' means he/she is here singing: remove the [] and keep the information
			if data[0] == "[" and data[-1] == "]":
				data = data[1:-1]
				self.is_music = True
			else: self.is_music = False
			if data[0] == '"' and  data[-1] == '"': data = data[1:-1] # for some reason some "" are around talker in the transcripts
			self.current_name = data
		# data concerns the quote
		else:
			# if the quote is the character singing, add '@' around the quote
			if self.is_music: self.current_sentence = "@" + data + "@"
			else: self.current_sentence = self.current_sentence + data
			
# this function takes a list of quotes from a season/episode number and format them as a string to be saved in a text file
def format_episode_quotes(season, episode, quotes):
	lines = []
	for character, quote in quotes:
		lines.append("S{0}$E{1}${2}${3}".format(season, episode, character, quote))
	return '\n'.join(lines)+'\n'

# get all transcripts url
transcripts_links=[x.replace("\n", "") for x in open("list_of_transcripts.txt", encoding="utf-8", mode="r").readlines()]

index_transcript = 0
parser = QuoteParser()
f = open("quotes_base_{0}_{1}.txt".format(MINIMUM, MAXIMUM), encoding="utf-8", mode="w+")

for season in range(1,10):
	for episode in range(1,27):
		# only 13 episodes in season 3
		if season == 3 and episode > 13: continue
		
		# get transcript through a https request for current episode
		url = transcripts_links[index_transcript]
		print ("Processing S{0}E{1}: {2}".format(season, episode, url))
		response = requests.get(url).content.decode("utf-8")
		# transcript is inside the <dl> tag in the received html
		start, end = response.find("<dl>"), response.rfind("</dl>")
		transcript = response[start:end]
		
		# reset parser variables between episodes
		parser.quotes = []
		parser.is_name = ""
		parser.is_music = False
		parser.current_name = ""
		parser.current_sentence = ""
		
		# parse the transcript and save the quotes in parser.quotes
		parser.feed(transcript)
		
		# add quotes of the current episode in output files
		f.write(format_episode_quotes(season, episode, parser.quotes))
		
		index_transcript += 1

f.close()
