from sqlalchemy import Column, Integer, String, TIMESTAMP, FetchedValue, text, Float, Text, JSON, ForeignKey, select, \
    Boolean
from sqlalchemy.dialects.postgresql import ARRAY
from sqlalchemy.orm import mapped_column, Mapped, relationship, Session, selectinload
from database.db import engine
from database.orms.Base import Base
from database.orms.UserORM import UserORM
from models.Expense import Expense
from database.orms.ProductORM import ProductORM
import pandas as pd


def dataset():
    session = Session(engine)

    expenses = session.query(ExpensesBudgetsDataset)
    df = pd.read_sql(sql=expenses.statement, con=engine)

    return df


class ExpensesBudgetsDataset(Base):
    __tablename__ = "expenses"

    id = Column(Integer, primary_key=True, autoincrement=True)
    user_id = Column("user_id", ForeignKey("users.id"), nullable=False)
    user: Mapped["UserORM"] = relationship()
    expense: Integer = Column(Integer)
    predicted_expense: Integer = Column(Integer, nullable=True)
    actual_budget: Integer = Column(Integer)
    estimated_budget: Integer = Column(Integer, nullable=True)
    age: Integer = Column(Integer)
    is_employed: bool = Column(Boolean)
