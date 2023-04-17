FROM python:3.11-slim

WORKDIR /app

RUN apt update

RUN pip install --upgrade pip

RUN pip install -U pip setuptools wheel

COPY ./requirements.txt requirements.txt

RUN pip install --no-cache-dir --upgrade -r requirements.txt

RUN python -m spacy download en_core_web_trf

CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8000", "--reload"]