from datetime import datetime

from models.Product import Product
from models.User import User
from request_validators.ExpenseRequest import BaseRequest


class Expense(BaseRequest):
    id: int
    user: User
    price: float
    feedback: str | None
    extra: str | None
    purchased_at: datetime
    product: Product

    class Config:
        orm_mode = True
