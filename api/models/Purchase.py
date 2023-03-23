from pydantic import BaseModel, constr
from models.Product import Product


class Purchase(BaseModel):
    id: int | None
    product: Product | None
    price: float | None
    purchased_at: str | None
    feedback: str | None
    extra: str | None
