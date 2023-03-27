from engine import engine, Base
from orms.PurchaseORM import PurchaseORM


PurchaseORM.metadata.create_all(engine)
