import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns

from database.orms.ExpensesBudgetsDatasetORM import dataset

dataset = dataset()

print(dataset)

#
# x = dataset['day', 'day_name', 'expense', 'actual_budget', 'age', 'is_employed']
# y = dataset['predicted_expense', 'estimated_budget']
