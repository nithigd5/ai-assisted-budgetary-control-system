from datetime import datetime

from pydantic import Field

from request_validators.UserRequest import UserRequest


class User(UserRequest):
    updated_at: datetime = Field(default=datetime.now(), title="User last updated at")
    created_at: datetime = Field(default=datetime.now(), title="User created at")
    id: int | None

    class Config:
        orm_mode = True
