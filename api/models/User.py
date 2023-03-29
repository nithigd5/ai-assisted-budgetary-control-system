from datetime import datetime

from pydantic import Field

from requests.UserRequest import UserRequest


class User(UserRequest):
    updated_at: datetime = Field(default=datetime.now(), title="User last updated at")
    created_at: datetime = Field(default=datetime.now(), title="User created at")
    id: int | None

    class Config:
        orm_mode = True
