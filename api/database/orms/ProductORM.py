from typing import List

from sqlalchemy import Column, TIMESTAMP, text, Float, Text, Integer, JSON, Boolean, String, select
from sqlalchemy.orm import Mapped, relationship
from sqlalchemy.orm import Session
from database.db import engine
from database.orms.Base import Base
from models.Product import Product


# from database.orms.PurchaseORM import PurchaseORM


def all_products():
    session = Session(engine)
    return list(map(lambda p: Product.from_orm(p[0]), session.execute(select(ProductORM)).all()))


class ProductORM(Base):
    __tablename__ = "products"

    id = Column(Integer, primary_key=True, autoincrement=True)
    created_at = Column(TIMESTAMP, server_default=text("NOW()"))
    updated_at = Column(TIMESTAMP, server_default=text("NOW()"), onupdate=text("NOW()"))
    min_price = Column(Float)
    max_price = Column(Float)
    category = Column(String)
    type = Column(String)
    daily_use = Column(Boolean)
    feedback = Column(Text, nullable=True)
    extra = Column(JSON, nullable=True)

    # purchases: Mapped[List] = relationship(back_populates="purchases")

