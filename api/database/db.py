from sqlalchemy import create_engine
from sqlalchemy.orm import declarative_base, Session

engine = create_engine("postgresql://postgres:password@localhost:5432/budgetary_system")

session = Session(engine)
