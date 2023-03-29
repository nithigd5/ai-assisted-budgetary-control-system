from datetime import datetime

from pydantic import BaseModel, Json, Field


class UserBudgetRequest(BaseModel):
    created_at: datetime = Field(default=datetime.now(), title="When did you purchase this ?")
    value: float = Field(gt=0, title="Budget Value")
    type: str | None = Field(title="What is the type of Budget ?")
