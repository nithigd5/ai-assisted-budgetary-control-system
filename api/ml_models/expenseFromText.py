import spacy
from spacy.matcher import Matcher


nlp = spacy.load("en_core_web_sm")

def extract(text):
    # Define the matcher pattern to extract product information
    matcher = Matcher(nlp.vocab)
    product = [{"LEMMA" : {"IN": ["purchase", "buy"]}}, {"POS": {"IN": ["PROPN", "NOUN"]}, "OP": "+"}]
    money = [{"POS": "NUM"}]
    location = [{"LEMMA": {"IN": ["at", "from", "in"]}}, {"POS": {"IN": ["NOUN", "PROPN"]}, "OP": "+"}]
    matcher.add("PRODUCT", [product])
    matcher.add("MONEY", [ money])
    matcher.add("LOCATION", [location])

    # Process the text with the matcher
    doc = nlp(text)
    matches = matcher(doc)

    expense = {}

    for (match_id, start, end) in matches:
      if match_id == nlp.vocab.strings["PRODUCT"]:
        expense["product"] = ' '.join(doc[start:end].text.split(' ')[1:-1])

      if match_id == nlp.vocab.strings['MONEY']:
        expense['price'] = doc[start:end].text

      if match_id == nlp.vocab.strings['LOCATION']:
        expense['mode'] = ' '.join(doc[start:end].text.split(' ')[1:])

    return expense
