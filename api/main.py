from fastapi import FastAPI

from routers import expenses, products, users, auth

app = FastAPI()

app.include_router(expenses.router, prefix="/purchases", tags=["purchases"])
app.include_router(products.router, prefix="/products", tags=["products"])
app.include_router(users.router, prefix="/users", tags=["users"])
app.include_router(auth.router, prefix="/auth", tags=["auth"])


@app.get("/")
async def root():
    return {"message": "Underdevelopment"}
