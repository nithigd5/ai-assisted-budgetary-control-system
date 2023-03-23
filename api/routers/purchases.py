from fastapi import APIRouter

from models.Purchase import Purchase

router = APIRouter()


@router.post('/')
async def store(purchase: Purchase):
    return purchase
