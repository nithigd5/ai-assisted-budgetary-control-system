from fastapi import FastAPI

from routers import purchases, products

app = FastAPI()

app.include_router(purchases.router, prefix="/purchases", tags=["purchases"])
app.include_router(products.router, prefix="/products", tags=["products"])


@app.get("/")
async def root():
    return {"message": "Underdevelopment"}
