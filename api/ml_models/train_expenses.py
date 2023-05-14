import pandas as pd
from sqlalchemy import update, select
from sqlalchemy.orm import Session
from sklearn.model_selection import train_test_split, GridSearchCV
from sklearn.preprocessing import OneHotEncoder, PolynomialFeatures, StandardScaler
from sklearn.compose import ColumnTransformer
from sklearn.pipeline import Pipeline
from sklearn.ensemble import RandomForestRegressor
from sklearn.linear_model import LinearRegression, Ridge
from sklearn.metrics import mean_squared_error, classification_report

from database.db import engine
from database.orms.ExpensesBudgetsDatasetORM import dataset, ExpensesBudgetsDataset


def select_model(dataset):
    x = dataset[['day', 'day_name', 'actual_budget', 'age', 'is_employed']]
    y = dataset['expense']

    X_train, X_test, y_train, y_test = train_test_split(x, y, test_size=0.2, random_state=42)

    # Preprocess data
    # Preprocess data
    ohe = OneHotEncoder()
    preprocessor = ColumnTransformer([
        ('ohe', ohe, ['day_name', 'age', 'is_employed'])
    ], remainder='passthrough')

    # Define models
    models = {
        'Random Forest': RandomForestRegressor(random_state=42),
        'Linear Regression': LinearRegression()
    }

    # Train and evaluate models
    for name, model in models.items():
        pipeline = Pipeline([
            ('preprocessor', preprocessor),
            ('model', model)
        ])
        pipeline.fit(X_train, y_train)
        y_pred = pipeline.predict(X_test)
        mse = mean_squared_error(y_test, y_pred)
        print(f'{name} MSE: {mse:.2f}')

    return X_train, X_test, y_train, y_test


def predict(user_id):
    data = dataset(user_id)

    x = data[['day', 'day_name', 'actual_budget', 'age', 'is_employed']]
    y = data['expense']

    preprocessor = pre_processor()

    # Train and evaluate models
    pipeline = Pipeline([
        ('preprocessor', preprocessor),
        ('model', RandomForestRegressor(random_state=42))
    ])
    pipeline.fit(x, y)

    update_with_predicted(pipeline, user_id)


def pre_processor():
    # Preprocess data
    ohe = OneHotEncoder()
    preprocessor = ColumnTransformer([
        ('ohe', ohe, ['day_name', 'age', 'is_employed'])
    ], remainder='passthrough')
    return preprocessor


def update_with_predicted(mlr, user_id):
    session = Session(engine)

    stmt = select(ExpensesBudgetsDataset).where(ExpensesBudgetsDataset.user_id == user_id)
    df = pd.read_sql(sql=stmt, con=engine)

    x = df[['day', 'day_name', 'actual_budget', 'age', 'is_employed']]

    predicted = mlr.predict(x)

    for p in zip(df['id'], predicted):
        session.execute(update(ExpensesBudgetsDataset).where(ExpensesBudgetsDataset.id == p[0])
                        .values(predicted_expense=round(p[1], 2)))

        session.commit()
