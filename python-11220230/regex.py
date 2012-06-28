verification_email = 'fed@test.free.com'
pattern = r'.*@(test.free.com|free.com.au|free.com.au.org|free.com.org)$'

import re
if re.search( pattern , verification_email):
	print('yes')
	# or on your case, return 'yes'