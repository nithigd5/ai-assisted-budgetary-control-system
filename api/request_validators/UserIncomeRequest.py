from datetime import datetime

from pydantic import BaseModel, Json, Field


class UserIncomeRequest(BaseModel):
    created_at: datetime = Field(default=datetime.now(), title="When did you get this income?")
    value: float = Field(gt=0, title="Income Value")
    type: str | None = Field(title="What is the type of Income ?")
