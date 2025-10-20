
# funtion for average
def calculate_average(grade):
    sum=0
    for i in range(len(grade)):
        sum+=grade[i]
    ave= sum/len(grade)
    rounded=round(ave,2)
    

# function for status
def get_status(average):
    if average>=75:
        return "Pass"
    else:
        return "Fail"
    
# list of grades
grade=[90.666,90.666,90.666,90.666,90.666]

#  print each grade
print("Student Grades:")
for i in range(len(grade)):
    print(grade[i])

#  call the functions
ave=calculate_average(grade)
print(ave)

# stat=get_status(ave)

# print(f"Average: {ave}")
# print(f"Status: {stat}")

