from fastapi import APIRouter

from database.db import session
from database.orms.UserORM import UserORM, all_users
from models.User import User
from requests.UserRequest import UserRequest

router = APIRouter()


@router.post('/')
async def store(user: UserRequest):
    user = UserORM(name=user.name, email=user.email, password=user.password.get_secret_value())

    session.add(user)

    session.commit()

    return User.from_orm(user)


@router.get('/', response_model=list[User])
async def get_all():
    return all_users()
