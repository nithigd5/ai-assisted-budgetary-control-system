import spacy
import json

nlp = spacy.load('en_core_web_sm')

text = "I purchased a product with id 21 for $500. It was good. The product was created on 2023-03-27T21:26:31.010000 and updated on 2023-03-27T21:26:31.010000. It belongs to Category and is of type Category. The minimum price is $12 and the maximum price is $233. It is used daily."

doc = nlp(text)

data = {}

for ent in doc.ents:
    if ent.label_ == 'DATE':
        if 'purchased_at' not in data:
            data['purchased_at'] = ent.text
    elif ent.label_ == 'MONEY':
        if 'price' not in data:
            data['price'] = float(ent.text.replace('$', ''))
    elif ent.label_ == 'CARDINAL':
        if 'id' not in data:
            data['id'] = int(ent.text)
        elif 'product' not in data:
            data['product'] = {}
            data['product']['id'] = int(ent.text)
    elif ent.label_ == 'ORG':
        if 'product' not in data:
            data['product'] = {}
            data['product']['category'] = ent.text
        elif 'feedback' not in data:
            data['feedback'] = ent.text
    elif ent.label_ == 'PERSON':
        if 'product' not in data:
            data['product'] = {}
            data['product']['type'] = ent.text

print(json.dumps(data, indent=4))