from datetime import datetime

from models.Product import Product
from requests.ExpenseRequest import BaseRequest


class Expense(BaseRequest):
    id: int
    price: float
    feedback: str | None
    extra: str | None
    purchased_at: datetime
    product: Product

    class Config:
        orm_mode = True
