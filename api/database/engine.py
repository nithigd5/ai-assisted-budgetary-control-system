from sqlalchemy import create_engine
from sqlalchemy.orm import declarative_base


Base = declarative_base()

engine = create_engine("postgresql://postgres:password@localhost:5432/budgetary_system")

