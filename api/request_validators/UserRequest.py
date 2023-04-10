from pydantic import BaseModel, Field, EmailStr, SecretStr


class UserRequest(BaseModel):
    name: str = Field(title="What is your name ?")
    email: EmailStr = Field(title="What is your email ?")
    password: SecretStr
