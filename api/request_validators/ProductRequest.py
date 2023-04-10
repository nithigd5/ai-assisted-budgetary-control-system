from datetime import datetime
from typing import Any

from pydantic import BaseModel, Json, Field


class ProductRequest(BaseModel):
    created_at: datetime = Field(default=datetime.now(), title="When did you purchase this ?")
    min_price: float = Field(gt=0, title="Product Price")
    max_price: float = Field(gt=0, title="Product Price")
    category: str = Field(title="What is the product category ?")
    type: str | None = Field(title="What is the type of product ?")
    daily_use: bool | None = Field(default=False, title="does this product bought frequently ?")
    feedback: str | None = Field(default=None, title="Feedback about the purchase")
    extra: Json[dict] | None = Field(title="Extra json data")
