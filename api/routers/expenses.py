from typing import Annotated

from fastapi import APIRouter, Body

from database.db import session
from database.orms.ExpenseORM import ExpenseORM, all_expenses
from models.Expense import Expense
from request_validators.ExpenseFromText import ExpenseFromText
from request_validators.ExpenseRequest import ExpenseRequest
from ml_models.expenseFromText import extract

router = APIRouter()


@router.post('/')
async def store(expenses: ExpenseRequest):
    expenses = ExpenseORM(**dict(expenses))

    session.add(expenses)

    session.commit()

    return Expense.from_orm(expenses)


@router.post('/from-text')
async def store(expense: ExpenseFromText):

    return extract(expense.text)

@router.get('/', response_model=list[Expense])
async def get_all():
    return all_expenses()
