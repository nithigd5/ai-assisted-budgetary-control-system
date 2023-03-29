from sqlalchemy import Column, TIMESTAMP, text, Integer, String, select
from sqlalchemy.orm import Session

from database.db import engine
from database.orms.Base import Base
from models.User import User


# from database.orms.PurchaseORM import PurchaseORM


def all_users():
    session = Session(engine)
    return list(map(lambda p: User.from_orm(p[0]), session.execute(select(UserORM)).all()))


class UserORM(Base):
    __tablename__ = "users"

    id = Column(Integer, primary_key=True, autoincrement=True)
    created_at = Column(TIMESTAMP, server_default=text("NOW()"))
    updated_at = Column(TIMESTAMP, server_default=text("NOW()"), onupdate=text("NOW()"))
    name = Column(String, nullable=False)
    email = Column(String, unique=True)
    password = Column(String)
