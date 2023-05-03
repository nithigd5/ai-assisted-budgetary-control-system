from sqlalchemy import create_engine
from sqlalchemy.orm import declarative_base, Session
import os

database_host = os.environ.get('DB_HOST', 'localhost')
database_port = os.environ.get('DB_PORT', '5432')
database_db = os.environ.get('DB_DATABASE', 'budgetary_system')
database_username = os.environ.get('DB_USERNAME', 'postgres')
database_password = os.environ.get('DB_PASSWORD', 'password')


engine = create_engine(f'postgresql://{database_username}:{database_password}@{database_host}:{database_port}/{database_db}')

session = Session(engine)
