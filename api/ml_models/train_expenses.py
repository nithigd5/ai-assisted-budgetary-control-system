import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns

from database.orms.ExpensesBudgetsDatasetORM import dataset

dataset = dataset()

x = dataset[['TV', 'Radio', 'Newspaper']]
y = dataset['Sales']
