from models.User import User
from requests.UserBudgetRequest import UserBudgetRequest


class UserBudget(UserBudgetRequest):
    id: int
    user: User

    class Config:
        orm_mode = True
