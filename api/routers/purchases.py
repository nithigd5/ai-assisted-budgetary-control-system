from fastapi import APIRouter
from sqlalchemy import select
from sqlalchemy.orm import Session, selectinload
from database.engine import engine
from database.orms.ProductORM import ProductORM
from database.orms.PurchaseORM import PurchaseORM, all_purchases
from models.Purchase import Purchase
from requests.PurchaseRequest import PurchaseRequest

router = APIRouter()


@router.post('/')
async def store(purchase: PurchaseRequest):
    session = Session(engine)

    purchase = PurchaseORM(**dict(purchase))

    session.add(purchase)

    session.commit()

    purchase.product = session.get(ProductORM, purchase.product)

    return Purchase.from_orm(purchase)


@router.get('/')
async def get_all():

    return all_purchases()
