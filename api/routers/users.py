from fastapi import APIRouter, Depends
from passlib.context import CryptContext
from typing import Annotated

from database.db import session
from database.orms.UserORM import UserORM, all_users
from helpers.auth import get_current_user
from models.User import User
from request_validators.UserRequest import UserRequest
from helpers.password import *

router = APIRouter()

pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")


@router.post('/')
async def store(user: UserRequest):
    user = UserORM(name=user.name, email=user.email, password=get_password_hash(user.password.get_secret_value()))

    session.add(user)

    session.commit()

    return User.from_orm(user)


@router.get('/', response_model=list[User])
async def get_all(current_user: Annotated[User, Depends(get_current_user)]):
    return all_users()
