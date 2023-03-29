from database.db import engine
from database.orms.Base import Base
from database.orms.ProductORM import ProductORM
from database.orms.ExpenseORM import ExpenseORM
from database.orms.UserIncomeORM import UserIncomeORM
from database.orms.UserBudgetORM import UserBudgetORM
# from database.orms.UserORM import UserORM


Base.metadata.create_all(engine)
