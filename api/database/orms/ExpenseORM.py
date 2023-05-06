from sqlalchemy import Column, Integer, String, TIMESTAMP, FetchedValue, text, Float, Text, JSON, ForeignKey, select
from sqlalchemy.dialects.postgresql import ARRAY
from sqlalchemy.orm import mapped_column, Mapped, relationship, Session, selectinload
from database.db import engine
from database.orms.Base import Base
from database.orms.UserORM import UserORM
from models.Expense import Expense
from database.orms.ProductORM import ProductORM


def all_expenses():
    session = Session(engine)

    purchases = session.execute(select(ExpenseORM).options(selectinload(ExpenseORM.product))).all()

    return list(map(lambda p: Expense.from_orm(p[0]), purchases))


class ExpenseORM(Base):
    __tablename__ = "expenses"

    id = Column(Integer, primary_key=True, autoincrement=True)
    user_id = Column("user_id", ForeignKey("users.id"), nullable=False)
    user: Mapped["UserORM"] = relationship()
    product_id = Column("product_id", ForeignKey("products.id"), nullable=False)
    product: Mapped["ProductORM"] = relationship()
    created_at = Column(TIMESTAMP, server_default=text("NOW()"))
    updated_at = Column(TIMESTAMP, server_default=text("NOW()"),  onupdate=text("NOW()"))
    price = Column(Float)
    feedback = Column(Text, nullable=True)
    mode = Column(String, nullable=True)
    extra = Column(JSON, nullable=True)
