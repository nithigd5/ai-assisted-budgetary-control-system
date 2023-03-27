from datetime import datetime

from pydantic import BaseModel, json, validator
from sqlalchemy import select
from sqlalchemy.orm import Session

from database.engine import engine
from database.orms.ProductORM import ProductORM
from models.Product import Product


class PurchaseRequest(BaseModel):
    product: int
    price: float
    feedback: str | None
    extra: str | None
    purchased_at: datetime

    @validator("product")
    def validate_valid_product(cls, v):
        session = Session(engine)
        product = session.get(ProductORM, v)

        if product is None:
            raise ValueError("Invalid Product")

        return v
