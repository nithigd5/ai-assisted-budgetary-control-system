from models.User import User
from request_validators.UserIncomeRequest import UserIncomeRequest


class UserIncome(UserIncomeRequest):
    id: int
    user: User

    class Config:
        orm_mode = True
