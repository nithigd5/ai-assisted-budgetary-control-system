from pydantic import BaseModel, json
from datetime import datetime

from requests.ProductRequest import ProductRequest


class Product(ProductRequest):
    id: int | None

    class Config:
        orm_mode = True
