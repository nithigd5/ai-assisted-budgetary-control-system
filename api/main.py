from fastapi import FastAPI
from models.train import Train

app = FastAPI()

@app.get("/")
def hello_world():
    return {"message": "OK"}

@app.get("/train")
def train():
    return {"success": True, "message": "Started Training model", "status": Train().train()}