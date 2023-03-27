from sqlalchemy import Column, Integer, String, TIMESTAMP, FetchedValue, text, Float, Text, JSON, ForeignKey, select
from sqlalchemy.dialects.postgresql import ARRAY
from sqlalchemy.orm import mapped_column, Mapped, relationship, Session, selectinload
from database.engine import Base, engine
from database.orms.ProductORM import ProductORM
from models.Purchase import Purchase


def all_purchases():
    session = Session(engine)

    purchases = session.execute(select(PurchaseORM).options(selectinload(PurchaseORM.product))).all()

    return list(map(lambda p: Purchase.from_orm(p[0]), purchases))


class PurchaseORM(Base):
    __tablename__ = "purchases"

    id = Column(Integer, primary_key=True, autoincrement=True)
    product_id = Column("product_id", ForeignKey("products.id"), nullable=False)
    product: Mapped["ProductORM"] = relationship()
    purchased_at = Column(TIMESTAMP, server_default=text("NOW()"))
    price = Column(Float)
    feedback = Column(Text, nullable=True)
    extra = Column(JSON, nullable=True)
