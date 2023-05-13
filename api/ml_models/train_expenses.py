import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.linear_model import LinearRegression
from sklearn.model_selection import train_test_split
from sklearn import metrics
from sqlalchemy import update
from sqlalchemy.orm import Session

from database.db import engine
from database.orms.ExpensesBudgetsDatasetORM import dataset, ExpensesBudgetsDataset



def pre_process(dataset):
    # ['day', 'day_name', 'expense', 'actual_budget', 'age', 'is_employed'][['predicted_expense', 'estimated_budget']]
    x = dataset[['day', 'day_name', 'actual_budget', 'age', 'is_employed']]
    y = dataset['expense']

    day_names = {'Monday': 1, 'Tuesday': 2, 'Wednesday': 3, 'Thursday': 4, 'Friday': 5, 'Saturday': 6, 'Sunday': 7}

    x['day_name'] = x['day_name'].map(lambda d: day_names[d], na_action='ignore')

    return x, y


def split(x, y):
    return train_test_split(x, y, test_size=0.3, random_state=100)


def train(x_train, y_train):
    # Fitting the Multiple Linear Regression model
    mlr = LinearRegression()
    mlr.fit(x_train, y_train)

    return mlr


def predict(user_id):
    data = dataset(user_id)

    x, y = pre_process(data)
    x_train, x_test, y_train, y_test = split(x, y)
    mlr = train(x_train, y_train)

    # Intercept and Coefficient
    print("Intercept: ", mlr.intercept_)
    print("Coefficients:")
    list(zip(x, mlr.coef_))

    # Prediction of test set
    y_pred_mlr = mlr.predict(x_test)

    update_with_predicted(mlr)


def update_with_predicted(mlr):
    session = Session(engine)

    expenses = session.query(ExpensesBudgetsDataset)
    df = pd.read_sql(sql=expenses.statement, con=engine)

    x = df[['day', 'day_name', 'actual_budget', 'age', 'is_employed']]

    day_names = {'Monday': 1, 'Tuesday': 2, 'Wednesday': 3, 'Thursday': 4, 'Friday': 5, 'Saturday': 6, 'Sunday': 7}

    x['day_name'] = x['day_name'].map(lambda d: day_names[d], na_action='ignore')

    predicted = mlr.predict(x)

    for p in zip(df['id'], predicted):

        session.execute(update(ExpensesBudgetsDataset).where(ExpensesBudgetsDataset.id == p[0])
                        .values(predicted_expense=round(p[1], 2)))

        session.commit()


# print(x_test)
# # Predicted values
# print("Prediction for test set: {}".format(y_pred_mlr))
#
# mlr_diff = pd.DataFrame({'Actual value': y_test, 'Predicted value': y_pred_mlr})
# mlr_diff.head()
#
# # Model Evaluation
#
# meanAbErr = metrics.mean_absolute_error(y_test, y_pred_mlr)
# meanSqErr = metrics.mean_squared_error(y_test, y_pred_mlr)
# rootMeanSqErr = np.sqrt(metrics.mean_squared_error(y_test, y_pred_mlr))
# print('R squared: {:.2f}'.format(mlr.score(x, y) * 100))
# print('Mean Absolute Error:', meanAbErr)
# print('Mean Square Error:', meanSqErr)
# print('Root Mean Square Error:', rootMeanSqErr)

# predict(1)
