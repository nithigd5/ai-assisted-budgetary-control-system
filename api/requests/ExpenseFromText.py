from datetime import datetime

from pydantic import BaseModel, Field


class ExpenseFromText(BaseModel):
    text: str = Field(
        default=None, title="Please explain what you purchased with price and its feedback", max_length=500
    )
    purchased_at: datetime = Field(default=datetime.now(), title="When did you purchase this ?")
