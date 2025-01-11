import pandas as pd

data=pd.read_csv('/Users/yugo_suzuki/mydevelopment/development/ds-3-wine/data-csv/winequality-red.csv')
data_5_10=data[5:11]
print(data_5_10)
