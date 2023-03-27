from fastapi import APIRouter
from sqlalchemy.orm import Session
from database.engine import engine
from database.orms.ProductORM import ProductORM, all_products
from models.Product import Product
from requests.ProductRequest import ProductRequest

router = APIRouter()


@router.post('/')
async def store(product: ProductRequest):
    session = Session(engine)

    product = ProductORM(**dict(product))

    session.add(product)

    session.commit()

    return Product.from_orm(product)


@router.get('/')
async def get_all():

    return all_products()
