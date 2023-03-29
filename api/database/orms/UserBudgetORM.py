from sqlalchemy import Column, TIMESTAMP, text, String, select, ForeignKey, Float, Integer
from sqlalchemy.orm import Session, Mapped, relationship

from database.db import engine
from database.orms.Base import Base
from database.orms.UserORM import UserORM
from models.UserIncome import UserIncome


def all_user_budgets():
    session = Session(engine)
    return list(map(lambda p: UserIncome.from_orm(p[0]), session.execute(select(UserBudgetORM)).all()))


class UserBudgetORM(Base):
    __tablename__ = "user_budgets"

    id = Column(Integer, primary_key=True, autoincrement=True)
    user_id = Column("user_id", ForeignKey("users.id"), nullable=False)
    user: Mapped["UserORM"] = relationship()
    value: float = Column(Float, nullable=False)
    created_at = Column(TIMESTAMP, server_default=text("NOW()"))
    updated_at = Column(TIMESTAMP, server_default=text("NOW()"), onupdate=text("NOW()"))
    type = Column(String, default=None, nullable=True)
