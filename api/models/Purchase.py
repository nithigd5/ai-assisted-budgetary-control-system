from datetime import datetime

from pydantic import BaseModel

from models.Product import Product
from requests.PurchaseRequest import PurchaseRequest


class Purchase(BaseModel):
    id: int
    price: float
    feedback: str | None
    extra: str | None
    purchased_at: datetime
    product: Product

    class Config:
        orm_mode = True
