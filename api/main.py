from fastapi import FastAPI
from routers import purchases

app = FastAPI()

app.include_router(purchases.router, prefix="/purchases", tags=["purchases"])


@app.get("/")
async def root():
    return {"message": "Underdevelopment"}
