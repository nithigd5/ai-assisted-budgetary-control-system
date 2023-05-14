from sqlalchemy import Column, Integer, String, TIMESTAMP, FetchedValue, text, Float, Text, JSON, ForeignKey, \
    Boolean, update, select
from sqlalchemy.dialects.postgresql import ARRAY
from sqlalchemy.orm import mapped_column, Mapped, relationship, Session, selectinload
from database.db import engine
from database.orms.Base import Base
from database.orms.UserORM import UserORM
from models.Expense import Expense
from database.orms.ProductORM import ProductORM
import pandas as pd
from datetime import datetime

def dataset(user_id):
    session = Session(engine)

    expenses = select(ExpensesBudgetsDataset).where(ExpensesBudgetsDataset.user_id == user_id).where(ExpensesBudgetsDataset.created_at <= datetime.now())
    df = pd.read_sql(sql=expenses, con=engine)

    return df


class ExpensesBudgetsDataset(Base):
    __tablename__ = "expenses_budgets_dataset"

    id = Column(Integer, primary_key=True, autoincrement=True)
    created_at = Column(TIMESTAMP, server_default=text("NOW()"))
    updated_at = Column(TIMESTAMP, server_default=text("NOW()"),  onupdate=text("NOW()"))
    user_id = Column("user_id", ForeignKey("users.id"), nullable=False)
    user: Mapped["UserORM"] = relationship()
    expense: Integer = Column(Integer)
    predicted_expense: Integer = Column(Integer, nullable=True)
    actual_budget: Integer = Column(Integer)
    estimated_budget: Integer = Column(Integer, nullable=True)
    age: Integer = Column(Integer)
    day: Integer = Column(Integer)
    day_name: String = Column(String)
    is_employed: bool = Column(Boolean)
