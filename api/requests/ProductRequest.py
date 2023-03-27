from datetime import datetime

from pydantic import BaseModel


class ProductRequest(BaseModel):
    created_at: datetime
    updated_at: datetime
    min_price: float
    max_price: float
    category: str
    type: str | None
    daily_use: bool | None
    feedback: str | None
    extra: str | None
