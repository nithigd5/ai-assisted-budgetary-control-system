from models.User import User
from requests.UserIncomeRequest import UserIncomeRequest


class UserIncome(UserIncomeRequest):
    id: int
    user: User

    class Config:
        orm_mode = True
