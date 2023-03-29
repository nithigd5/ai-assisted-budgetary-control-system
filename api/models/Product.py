from pydantic import BaseModel, json, Field
from datetime import datetime

from requests.ProductRequest import ProductRequest


class Product(ProductRequest):
    updated_at: datetime = Field(default=datetime.now(), title="Product last updated at")
    id: int | None

    class Config:
        orm_mode = True
