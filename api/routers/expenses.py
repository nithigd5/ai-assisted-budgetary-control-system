from typing import Annotated

from fastapi import APIRouter, Body

from database.db import session
from database.orms.ExpenseORM import ExpenseORM, all_expenses
from models.Expense import Expense
from request_validators.ExpenseFromText import ExpenseFromText
from request_validators.ExpenseRequest import ExpenseRequest
from ml_models.expenseFromText import extract
from textblob import TextBlob

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


@router.post('/analyze-sentiment')
def sentiment_analysis(feedback: Annotated[dict]):
    def getSubjectivity(text):
        return TextBlob(text).sentiment.subjectivity

    # Create a function to get the polarity
    def getPolarity(text):
        return TextBlob(text).sentiment.polarity

    # Create two new columns ‘Subjectivity’ & ‘Polarity’
    feedback['TextBlob_Subjectivity'] = getSubjectivity(feedback['feedback'])
    feedback['TextBlob_Polarity'] = getPolarity(feedback['feedback'])

    def getAnalysis(score):
        if score < 0:
            return 'Negative'
        elif score == 0:
            return 'Neutral'
        else:
            return 'Positive'

    feedback['TextBlob_Analysis'] = getAnalysis(feedback['TextBlob_Polarity'])
    return feedback
