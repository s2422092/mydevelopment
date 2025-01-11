import pandas as pd
data = pd.read_csv('/Users/yugo_suzuki/mydevelopment/development/ds-3-wine/data-csv/winequality-red.csv')
data[data['quality']>=6].sort_values('quality',ascending=False)
print(data[data['quality']>=6].sort_values('quality',ascending=False))