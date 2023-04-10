from models.User import User
from request_validators.UserBudgetRequest import UserBudgetRequest


class UserBudget(UserBudgetRequest):
    id: int
    user: User

    class Config:
        orm_mode = True
