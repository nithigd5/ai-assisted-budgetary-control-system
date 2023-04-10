from datetime import datetime
from typing import Any

from pydantic import BaseModel, validator, Field, Json

from database.db import session
from database.orms.ProductORM import ProductORM


class BaseRequest(BaseModel):
    price: float = Field(gt=0, title="Product Price")
    feedback: str | None = Field(default=None, title="Feedback about the purchase")
    extra: Json[dict] | None = Field(title="Extra json data")
    purchased_at: datetime = Field(default=datetime.now(), title="When did you purchase this ?")


class ExpenseRequest(BaseRequest):
    product: int = Field(title="Product Id")

    @validator("product")
    def validate_valid_product(cls, v):
        product = session.get(ProductORM, v)

        if product is None:
            raise ValueError("Invalid Product")

        return product
