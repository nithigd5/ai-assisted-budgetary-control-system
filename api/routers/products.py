from fastapi import APIRouter

from database.db import session
from database.orms.ProductORM import ProductORM, all_products
from models.Product import Product
from request_validators.ProductRequest import ProductRequest

router = APIRouter()


@router.post('/')
async def store(product: ProductRequest):
    product = ProductORM(**dict(product))

    session.add(product)

    session.commit()

    return Product.from_orm(product)


@router.get('/', response_model=list[Product])
async def get_all():
    return all_products()
