#@author Yashn37
# -*- coding: utf-8 -*-
# get all transcripts url. They are listed on the the https://mlp.fandom.com/wiki/Friendship_is_Magic_animated_media page

import requests
import re

url = "https://mlp.fandom.com/wiki/Friendship_is_Magic_animated_media"

response = requests.get(url).content.decode("utf-8")
# all transcript links are like "/wiki/Transcripts/(.*?)" - select only them
transcripts_url = ["https://mlp.fandom.com" + x.group()[1:-1] for x in re.finditer( r'"/wiki/Transcripts/(.*?)"', response)]

# save transcripts links
f = open("list_of_transcripts.txt", encoding="utf-8", mode="w")
f.write('\n'.join(transcripts_url))
f.close()
