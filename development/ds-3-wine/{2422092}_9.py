import pandas as pd
data=pd.read_csv('/Users/yugo_suzuki/mydevelopment/development/ds-3-wine/data-csv/winequality-red.csv')
data.groupby('quality').mean()
print(data.groupby('quality').mean())