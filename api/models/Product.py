from pydantic import BaseModel


class Product(BaseModel):
    id: int
    name: str
    created_at: int
    updated_at: int
    minPrice: float
    maxPrice: float
